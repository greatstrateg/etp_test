<template>
    <header>
        <div>
            <div class="header__title">Гарантийные обязательства на доставку грузов</div>
            <authComponent />
        </div>
    </header>
    <main>
        <div class="p-1">
            <listGoodsComponent v-bind:arrGoods='arrGoods' />
            <sumGoodsComponent v-bind:arrGoods='arrGoods' />
            <xmlGoodsComponent v-bind:arrGoods='arrGoods'/>
        </div>
    </main>
</template>

<script>
import sumGoodsComponent from "./components/sumGoodsComponent.vue";
import listGoodsComponent from "./components/listGoodsComponent.vue";
import xmlGoodsComponent from "./components/xmlGoodsComponent.vue";
import authComponent from "./components/authComponent.vue";

export default {
    components: {
        'sumGoodsComponent': sumGoodsComponent,
        'listGoodsComponent': listGoodsComponent,
        'xmlGoodsComponent': xmlGoodsComponent,
        'authComponent': authComponent,
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
