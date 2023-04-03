<template>
    <div v-if="arr_goods.length" class="p-1 mb-4">

        <div v-on:click="createXmlDoc" class="btn btn-primary">Создать XML</div>

        <div v-if="flagGenXml">

            <div class="form-group mt-2">
                <textarea v-model="docString" class="form-control" rows="5"></textarea>
            </div>

            <div class="form-group mt-2" >

                <div v-on:click="listCerf" class="btn btn-primary mt-2">Найти сертификаты</div>

            </div>
            <div v-if="!flagCryptoInit"  class="form-group mt-2" >

                <div class="text-danger fs-5">Ошибка: плагин CryptoPro не установлен в браузер</div>

            </div>
            <div v-if="(arrCerf.length>0)" class="form-group mt-2" >

                <label for="selectCerfMy1" class="mb-1">Выбрать сертификат:</label>

                <select v-model="selectCerf" class="form-control" id="selectCerfMy1">
                    <option v-for="(el, index) in arrCerf" v-bind:value="{index}">
                       {{ index }} {{ el.subject.name }}
                    </option>
                </select>

                <div v-if="selectCerf!=-1">

                    <div class="btn btn-primary mt-2" v-on:click="goCrypto">Подписать XML</div>

                </div>

            </div>
        </div>

        <div v-if="docCrypto.length>0" class="form-group mt-2">

            <textarea v-model="docCrypto" class="form-control" rows="5"></textarea>

        </div>

        <div v-if="docString.length>0 && docCrypto.length>0">

            <div class="btn btn-success mt-2" v-on:click="sendXMLDoc">Отправить на сервер</div>

            <div v-if="stepFinal" class="text-success d-inline font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
            </div>

        </div>
    </div>
</template>

<script>
/**
 * load Helper Class
 * from cryptopro.js
 */
let crypto = new CryptoHelper;

export default {
    name: "xmlGoodsComponent",
    props: {
        arr_goods: Array,
    },
    data() {
        return {
            docXML: '',
            docString: '',
            docCrypto: '',
            arrCerf: Array(),
            selectCerf: -1,
            flagGenXml: false,
            flagCryptoInit: -1,
            stepFinal: false,
        }
    },
    methods: {
        /**
         * View system modal dialog
         * and if it success load certificates list
         * @return arrCerf
         */
        listCerf() {
            crypto.init()
                .then( async () => {
                   if(crypto.isReady) {
                       crypto.getCertificates().then((certs) => {
                           certs.forEach(el => {
                               this.arrCerf.push(el);
                           });
                           this.flagCryptoInit = true;
                       });
                   }
                })
                .catch(
                    () => this.flagCryptoInit = false
                );
        },

        /**
         * Make crypto signature
         * @return docCrypto
         */
        goCrypto() {
            const cerf = Object.assign({}, this.arrCerf[this.selectCerf.index]);

            console.log(crypto.sign(cerf, this.docString));

            crypto.sign(cerf, this.docString).then((signMessage) => {
                this.docCrypto = signMessage;
            });
        },

        /**
         * create XML document
         * from user body form data
         * sets flagGenXml true|false
         * @return docString
         */
        createXmlDoc() {
            this.flagGenXml = false;

            if( !this.arr_goods.length ) { return; }

            this.docXML = document.implementation.createDocument(null,"root",null);
            this.arr_goods.forEach( (el) => {
                let goods = this.docXML.createElement("goods");

                let name = this.docXML.createElement("name");
                let quality = this.docXML.createElement("quality");
                let guarant = this.docXML.createElement("guarant");

                let nameVal = document.createTextNode(el[0]);
                let qualityVal = document.createTextNode(el[1]);
                let guarantVal = document.createTextNode(el[2]);

                name.appendChild(nameVal);
                quality.appendChild(qualityVal);
                guarant.appendChild(guarantVal);

                goods.appendChild(name);
                goods.appendChild(quality);
                goods.appendChild(guarant);

                this.docXML.documentElement.appendChild(goods);
            } );
            let s = new XMLSerializer();
            this.docString = s.serializeToString(this.docXML);
            this.flagGenXml = true;
        },

        /**
         * send XML string
         * and crypto signature
         * to server
         * set flag stepFinal true|false
         */
        sendXMLDoc() {
            this.stepFinal = false;
            axios.post(
                "/server/xml",
                {
                    xml: this.docString,
                    crypto: this.docCrypto,
                }
            )
            .then((response) => {
                console.log("SUCCESS");
                console.log(response);
                this.stepFinal = true;
            })
            .catch( (error) => {
                console.log("ERROR");
                console.log(error);
            });
        }
    },
}
</script>

<style scoped>
    .btn {
        min-width: 150px;
    }
</style>
