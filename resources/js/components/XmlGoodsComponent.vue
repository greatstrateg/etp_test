<template>
    <div v-if="arr_goods.length" class="p-1 mb-4">
        <div class="btn btn-primary" v-on:click="createXmlDoc">Создать XML</div>&nbsp;
        <div v-if="docXML!=null" class="mt-2">
            <div class="form-group">
                <textarea v-if="docXML!=null" class="form-control" rows="5" v-model="docString"></textarea>
            </div>
            <div class="form-group mt-2">
                <div class="btn btn-primary" v-on:click="listCerf">Получить сертификаты</div>&nbsp;
                <div v-if="successFlag" class="text-success d-inline font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                 </svg>
                </div>
                <div class="form-group mt-2" v-if="(arrCerf.length>0)">
                    <label for="selectCerfMy1" class="mb-1">Выбрать сертификат:</label>
                    <select class="form-control" v-model="selectCerf" id="selectCerfMy1">
                        <option v-for="(el, index) in arrCerf" v-bind:value="{index}">
                           {{ index }} {{ el }}
                        </option>
                    </select>
                </div>
                <div v-if="selectCerf!=-1" class="mt-2">
                    <div class="btn btn-primary" v-on:click="goCrypto">Зашифровать XML</div>&nbsp;
                </div>
            </div>
        </div>
        <div v-if="docCrypto!=null" class="form-group">
            <textarea v-if="docXML!=null" class="form-control" rows="5" v-model="docCrypto"></textarea>
        </div>
    </div>
</template>

<script>
let crypto = new CryptoHelper;
export default {
    name: "xmlGoodsComponent",
    props: {
        arr_goods: Array,
    },
    data() {
        return {
            docXML: null,
            docString: null,
            docCrypto: null,
            successFlag: false,
            arrCerf: Array(),
            selectCerf: -1,
        }
    },
    methods: {
        listCerf() {
            crypto.init().then( async () => {
               if(crypto.isReady) {
                   crypto.getCertificates().then((certs) => {
                       certs.forEach(el => {
                           //console.log(el.$original)
                           this.arrCerf.push(el.$original);
                       });
                      //console.log(this.arrCerf);
                      //console.log(JSON.parse(JSON.stringify(this.arrCerf[1])));
                   //
                   //
                   //     console.log(this.arrCerf[1].$original);
                   });

               }
            });
        },
        goCrypto() {
            const cerf = Object.assign({}, this.arrCerf[1]);

            console.log(crypto.sign(cerf, this.docString));

            crypto.sign(cerf, this.docString).then((signMessage) => {
                this.docCrypto = signMessage;
            });
        },
        createXmlDoc() {
            this.successFlag = false;

            if( !this.arr_goods.length ) { return; }

            this.docXML = document.implementation.createDocument(
                null,
                "root",
                null
            );
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
            //send XML doc
            //this.sendXMLDoc();
        },
        //send with axios to /server XML doc
        sendXMLDoc() {
            let s = new XMLSerializer();
            axios.post(
                "/server/xml",
                {obj: s.serializeToString(this.docXML)}
            )
            .then((response) => {
                console.log("SUCCESS");
                console.log(response);
                this.successFlag = true;
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

</style>
