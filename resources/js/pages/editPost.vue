<template>
	<div v-if="this.$store.state.user" class="container">
			<button type="button" class="btn btn-outline-primary btn-sm mt-2" @click="logout">Logout</button>
			<button type="button" class="btn btn-outline-primary btn-sm mt-2" @click="goBack">Dashboard</button>
		<h1 class="text-center p-3">Editar</h1>
		<hr>
		<div class="">
			<label class="mb-2" for="FormControlTextarea1">Faça seu comentário:</label>
			<textarea v-model="posts.comments" 
				maxlength="280"
				class="form-control" 
				id="FormControlTextarea1" 
				placeholder="O que voĉe esta pensando?" 
				required
					rows="3">
			</textarea>
			<button type="button" class="btn btn-outline-success btn-sm mt-2" @click="update">Alterar</button>
	</div>
</div>
</template>

<script>
import axios from 'axios';
import { route } from 'ziggy-js';
import swal from 'sweetalert';

export default {
    data(){
        return{
			posts:[],		
			newComments: '',
		}
    },
	created(){
		this.getPost()
	},
	methods: {
		goBack(){
			let url = route('api.posts.index')
			let token = this.$store.state.userToken || localStorage.getItem('token');
			axios.get(url, 
			{ headers: { Authorization: 'Bearer ' + token } }
			).then(response =>{
				this.posts = response.data.data;
				this.$router.replace({ name: "dashboard" })	
			}).catch(error => {
				console.log(error)
			});
		},
		getPost(){
			let id = localStorage.getItem('idPost')
			console.log('idpostuser:', id)
			let url = route('api.posts.edit', {id: id})
			let token = this.$store.state.userToken || localStorage.getItem('token');
			axios.get(
				url,
				{ headers: { Authorization: 'Bearer ' + token } },
			).then(response => {
				const apiresponse = response.data
				if(apiresponse){	
					this.posts = apiresponse
					console.log('posts', this.posts)
				}
			})
		},
		logout(){
			let url = route('auth.logout')
			let token = this.$store.state.userToken || localStorage.getItem('token');
			axios.post(
				url,
				{},
				{ headers: { Authorization: 'Bearer ' + token } }
			).then(() =>{
				this.$store.commit('clearAllState')
				this.$router.replace({ name: "login" })
			})
		},
		update(){
			let url = route('api.posts.update')
			let token = this.$store.state.userToken || localStorage.getItem('token');
			axios.put(
				url,
				this.posts,
				{ headers: { Authorization: 'Bearer ' + token } },
			).then(response => {
				const apiresponse = response.data
				if(apiresponse){
					alert('Comentário alterado com sucesso!')
					this.$router.replace({ name: "dashboard" })
				}
			})
		},
	},
}
</script>