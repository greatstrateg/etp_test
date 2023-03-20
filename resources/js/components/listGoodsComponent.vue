<template>
    <!-- Перечень товаров -->
    <div class="p-1"><h3>Перечень товаров</h3></div>
    <table v-if="arrGoods.length>0" class="table_good p-1">
        <tr>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Сумма гарантий (₽)</th>
            <th></th>
        </tr>
        <tr v-for="(el, index) in arrGoods">
            <td>{{ el[0] }}</td>
            <td>{{ el[1] }}</td>
            <td>{{ el[2] }}</td>
            <td><div class="del btn btn-primary" v-on:click="editArrEl(index)"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
            </svg></div> <div class="del btn btn-danger" v-on:click="delArrEl(index)">✖</div></td>
        </tr>
    </table>
    <div class="p-1" v-else><h4>Товаров нет</h4></div>

    <!-- Модальное окно -->
    <div class="p-1 pt-2">
        <div class="btn btn-primary" v-on:click="openCloseModal">+ Добавить товар</div>
    </div>
    <div v-if="flagModal" class="modal fade show" id="addGood" style="display: block; background: black;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить товар</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть" v-on:click="openCloseModal"></button>
                </div>
                <div class="modal-body">
                    <div class="form_good">
                        <div>
                            <div><label class="col-form-label">Товар</label></div>
                            <div><input type="text" class="form-control" v-bind:class="nameClass" v-model="nameGoods"></div>
                        </div>
                        <div>
                            <div><label class="col-form-label">Количество</label></div>
                            <div><input type="number" min="1" step="any" class="form-control" v-bind:class="qualityClass" v-model="qualityGoods"></div>
                        </div>
                        <div>
                            <div><label class="col-form-label">Стоимость</label></div>
                            <div><input type="number" min="1" step="any" class="form-control" v-bind:class="guarantClass" v-model="guarantGoods"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" v-on:click="pushArrEl()">+ Добавить</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="openCloseModal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "listGoodsComponent",
    props: {
        arrGoods: Array,
    },
    data() {
        return {
            flagModal: false,

            nameClass: 'valid',
            qualityClass: 'valid',
            guarantClass: 'valid',

            numGoods: -1,
            nameGoods: '',
            qualityGoods: 1,
            guarantGoods: '',
        }
    },
    methods: {
        delArrEl(index) {
            this.arrGoods.splice(index,1);
        },
        editArrEl(index) {
            this.nameGoods     = this.arrGoods[index][0];
            this.qualityGoods  = this.arrGoods[index][1];
            this.guarantGoods  = this.arrGoods[index][2];
            this.numGoods      = index;

            this.openCloseModal();
        },
        pushArrEl() {
            // validation
            this.nameGoods == '' ? this.nameClass = 'is-invalid' : this.nameClass = 'is-valid';
            this.qualityGoods == '' ? this.qualityClass = 'is-invalid' : this.qualityClass = 'is-valid';
            this.guarantGoods == '' ? this.guarantClass = 'is-invalid' : this.guarantClass = 'is-valid';
            if(this.nameGoods == '' || this.qualityGoods == '' || this.guarantGoods == '') {
                return;
            }

            //edit or add good
            if(this.numGoods!=-1) {
                this.arrGoods.splice(this.numGoods, 1, [this.nameGoods, this.qualityGoods, this.guarantGoods]);
                this.numGoods = -1;
            } else {
                this.arrGoods.push([this.nameGoods, this.qualityGoods, this.guarantGoods]);
            }

            //close modal window
            setTimeout(() => {this.openCloseModal()}, 1000 );
        },
        openCloseModal() {
            this.flagModal = (this.flagModal == true) ? false : true;

            //clear tag-classes and values
            if(!this.flagModal) {
                this.nameClass = this.qualityClass = this.guarantClass = '';
                this.nameGoods = '';
                this.guarantGoods = '';
                this.qualityGoods = 1;
            }
        }
    }
}
</script>

<style scoped>

</style>
