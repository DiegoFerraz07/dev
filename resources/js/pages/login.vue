<template>
	
    <h1 class="">Bem-Vindo</h1>
    <div class="form-group">
        <label class=" " for="email">Email</label>
        <input type="text"
            class="form-control"
			v-model="user.email"
            required
            placeholder="Digite Seu Email"
        />
    </div>
    <div class="form-group">
        <label for="password">Senha</label>
        <input type="text"
            class="form-control"
			v-model="user.password"
            required
            placeholder="Digite Sua Senha"
        />
    </div>
    <button @click="login" class="btn btn-success mt-2">Entrar</button>
    <div>
        <a>Não possui conta? Cadastra-se já!</a>
    </div>
</template>

<script>
import axios from 'axios';
import { route } from 'ziggy-js';

export default {
    data(){
        return{
			user: {
				email: this.email,
				password: this.password
			},
			routeLogin: route('auth.login'),
		}
    },
	methods: {
		login(){
			let route = this.routeLogin;
			console.log(route);
			axios.post( 
				route, 
				this.user
			).then(response =>{
				const apiresponse = response.data;	
				console.log(apiresponse)
				if(apiresponse.access_token){
					this.$store.commit('setUserToken', apiresponse.access_token)
					this.$routes.replace({ name: "dashboard" })
				}
				console.log(this.$store.state)
			}).catch(error => {
				console.log(error)
			});
		}
	},
}
</script>