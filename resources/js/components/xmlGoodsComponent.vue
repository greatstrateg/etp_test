<template>
    <div class="p-1">
        <div class="btn btn-success" v-on:click="createXmlDoc">Создать xml и отправить</div>&nbsp;
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
        }
    },
    methods: {
        createXmlDoc() {
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
                "/server",
                {obj: s.serializeToString(this.docXML)}
            )
            .then((response) => {
                console.log("SUCCESS");
                console.log(response);
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
