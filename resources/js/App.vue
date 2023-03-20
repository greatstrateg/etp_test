<template>
    <listGoodsComponent v-bind:arrGoods='arrGoods' />
    <sumComponent v-bind:arrGoods='arrGoods' />
    <xmlGoodsComponent v-bind:arrGoods='arrGoods'/>
</template>

<script>
import sumComponent from "./components/sumComponent.vue";
import listGoodsComponent from "./components/listGoodsComponent.vue";
import xmlGoodsComponent from "./components/xmlGoodsComponent.vue";

export default {
    components: {
        'sumComponent': sumComponent,
        'listGoodsComponent': listGoodsComponent,
        'xmlGoodsComponent': xmlGoodsComponent,
    },
    data() {
        return {
            arrGoods: [["Шкафы", "12", "1230000"], ["Ноутбуки", "100", "9900000"], ["Смартфоны", "500", "51000000"]],
        }
    }
}
</script>

<style scoped>

</style>
