<template>
	<div class="container">	
		<div class="row">
			<div class="main">
			<div>
				<h1 class="text-center p-5">Cadastro</h1>
				<hr>
			</div>
				<div class="form-group">
					<label class="p-1" for="name">Nome:</label>
					<input type="text"
						class="form-control"
						v-model="user.name"
						required
						placeholder="Digite Seu Nome"
					/>
				</div>
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
				<button @click="save" class="btn btn-success mt-4">Salvar</button>
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
				name: this.name,
				email: this.email,
				password: this.password
			},
			routeRegister: route('auth.register'),
		}
    },
	methods: {
		save(){
			let route = this.routeRegister;
			console.log(route);
			if(!this.user.name || !this.user.email || !this.user.password){
				alert('Por favor informe seus dados')
				return
			}
			axios.post( 
				route, 
				this.user
			).then(response =>{
				const apiresponse = response.data;	
				console.log(apiresponse)
				if(apiresponse){
					alert('Usuario criado com sucesso')
					this.$router.replace({ name: "login" })
				}else{
					alert('Erro ao cadastrar o usuario ')
					return 
				}
			}).catch(error => {
				console.log(error)
			});
		}
	},
}
</script>