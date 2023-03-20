<template>
    <div class="header__button"><div class="btn btn-primary btn-sm" v-on:click="openCloseModalAuth">Вход</div></div>
    <!-- Модальное окно -->
    <div v-if="flagModalOpen" class="modal fade show" id="addGood" style="display: block; background: black;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вход в админ-панель</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть" v-on:click="openCloseModalAuth"></button>
                </div>
                <div class="modal-body">
                    <div class="form_good">
                        <div class="bg-info p-1 form-info-text">
                            Тестовые данные для входа:<br/>
                            логин: <b>admin</b> <br/>
                            пароль: <b>laravel</b>
                        </div>
                        <div>
                            <div><label class="col-form-label">Логин</label></div>
                            <div><input type="text" class="form-control" v-bind:class="loginClass" v-model="loginUser"></div>
                        </div>
                        <div>
                            <div><label class="col-form-label">Пароль</label></div>
                            <div><input type="password" class="form-control" v-bind:class="passClass" v-model="passUser"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" v-on:click="sendAuth()">Войти</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="openCloseModalAuth">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "authComponent",
    data() {
        return {
            flagModalOpen: false,
            loginUser: 'admin',
            passUser: 'laravel',
            loginClass: '',
            passClass: '',
            errorMessage: '',
        }
    },
    methods: {
        openCloseModalAuth() {
            if(!this.flagModalOpen) {
                axios
                    .post("/server/auth-check")
                    .then((response) => {
                        if (response.data == "success") {
                            window.location.replace("/admin");
                        }
                        else {
                            this.flagModalOpen = true;
                        }
                    })
                    .catch((error) => {
                        this.flagModalOpen = true;
                    });
            }
            else {
                this.flagModalOpen = false;
            }

        },
        sendAuth() {
            axios.post(
                "/server/auth",
                {'name': this.loginUser, 'password': this.passUser}
            )
            .then((response) => {
                if(response.data == "success") {
                    window.location.replace("/admin");
                }
            })
            .catch( (error) => {
                console.log("ERROR");
                console.log(error);
            });
        }
    }
}
</script>

<style scoped>

</style>
