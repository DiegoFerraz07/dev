<template>
	<div class="container-fluid">
		<div class="container">
			<h2 class="text-center p-4" id="title">Seja Bem-vindo</h2>
			<hr>
				<div class="row">
					<div class="col-md-5 width-10px">
						<img src="/resources/assets/atlas.png"  width="500" height="400" alt="">
					</div>	

					<div class="col-md-2">
						<!-------null------>
					</div>

					<div class="col-md-5">
						<h3 class="text-right pt-5" id="title">Faça Seu Login</h3>
						<div class="form-group">
							<label class="p-1" for="email">Email:</label>
							<input type="text"
								class="form-control"
								v-model="user.email"
								required
								placeholder="Digite Seu Email"
							/>
						</div>
						<div class="form-group">
							<label class="p-1" for="password">Senha:</label>
							<input type="password"
								class="form-control"
								v-model="user.password"
								required
								placeholder="Digite Sua Senha"
							/>
						</div>
						<button @click="login" class="btn btn-outline-success mt-2">Entrar</button><br>
						<div class="pt-2">
							<RouterLink to="/register">Ainda não possui conta? Cadastre-se!</RouterLink>
						</div>
					</div>
				</div>
		</div>
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
			if(!this.user.email || !this.user.password){
				alert('Por favor informe os dados de autenticação')
				return
			}
			axios.post( 
				route, 
				this.user
			).then(response =>{
				const apiresponse = response.data;	
				console.log(apiresponse)
				if(apiresponse.access_token){
					this.$store.commit('setUserToken', apiresponse.access_token)
					localStorage.setItem('token', apiresponse.access_token)
					this.$router.replace({ name: "dashboard" })
				}else{
					alert('email ou senha incorretos, tente novamente ')
					return 
				}
			}).catch(error => {
				console.log(error)
			});
		}
	},
}
</script>