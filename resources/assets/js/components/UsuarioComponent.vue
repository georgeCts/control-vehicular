<template>
    <div class="col-md-4 padding-0 text-center">
       <div :class="[badgeClass, (user.pk_usuario_tipo == 1) ? 'bg-dark' : 'bg-grey', paddingClass]">
            <div class="badges-ribbon">
                    <div class="badges-ribbon-content badge-success" v-if="user.pk_usuario_tipo == 1">{{ tipo.usuario_tipo }}</div>
                    <div class="badges-ribbon-content badge-info" v-else>{{ tipo.usuario_tipo }}</div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center text-white"><h3>{{ user.nombre + ' ' + user.apellido_paterno }}</h3></div>
                <img :src="'/assets/img/' + user.imagen" class="img-circle avatar-users" />                        
            </div>
            
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center" style="margin-top:30px;">
                    <a href="#" role="button" class="btn btn-warning">Editar Perfil</a>
                </div>
            </div>

            <hr />

            <div class="text-left">
                <p class="font-13 text-white">
                    <strong>Email:</strong>
                    <span class="m-l-15">{{ user.correo }}</span>
                    <br />
                    <strong>N&uacute;mero de Accesos:</strong>
                    <span class="m-l-15">{{ user.numero_accesos }}</span>
                    <br />
                    <strong>&Uacute;ltimo de Acceso:</strong>
                    <span class="m-l-15">{{ user.ultimo_acceso_fecha }}</span>
                </p>
            </div>           
        </div>
    </div>
</template>

<script>
export default {
    props: ['user', 'tipo'],

    data() {
        return {
            user: this.user,
            tipo: this.tipo,
            badgeClass: 'badges-v1',
            paddingClass: 'padding-15',
        }
    }
}
</script>

<style>

</style>
