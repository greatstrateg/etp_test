<template>
    <div v-if="arrGoods.length" class="p-1">
        <div class="btn btn-success" v-on:click="createXmlDoc">Создать xml и отправить</div>&nbsp;
        <div v-if="successFlag" class="text-success d-inline font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
         </svg>
        </div>
    </div>
</template>

<script>
export default {
    name: "xmlGoodsComponent",
    props: {
        arrGoods: Array,
    },
    data() {
        return {
            docXML: null,
            successFlag: false,
        }
    },
    methods: {
        createXmlDoc() {
            this.successFlag = false;

            if( !this.arrGoods.length ) { return; }

            this.docXML = document.implementation.createDocument(
                null,
                "root",
                null
            );
            this.arrGoods.forEach( (el) => {
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

            //send XML doc
            this.sendXMLDoc();
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
