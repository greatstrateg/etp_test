<template>
    <!-- Сумма гарантий-->
    <div class="grid_sum p-1">
        <div>Сумма гарантий: </div>
        <div><span>{{ sumGuarant }}</span> ₽</div>
    </div>
    <div class="grid_sum p-1">
        <div>Страховой взнос 0.8%: </div>
        <div><span>{{ sumPay }}</span> ₽</div>
    </div>
</template>

<script>
export default {
    name: "summComponent",
    props: {
        arrGoods: Array,
    },
    computed: {
        sumGuarant() {
            let sum = 0;
            this.arrGoods.forEach( (el) => { sum += el[2]*1; } )
            return Math.ceil(sum).toFixed(2);
        },
        sumPay() {
            return Math.ceil(this.sumGuarant*0.008).toFixed(2);
        },
    }
}
</script>

<style scoped>

</style>
