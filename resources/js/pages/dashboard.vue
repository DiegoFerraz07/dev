<template>
	<div v-if="this.$store.state.user" class="container">
			<button type="button" class="btn btn-outline-primary btn-sm mt-2" @click="logout">Logout</button>
		<h1 class="text-center p-3">Dashboard</h1>
		<hr>
		<div class="">
			<label class="mb-2" for="FormControlTextarea1">Faça seu comentário:</label>
			<textarea v-model="newComments" 
				maxlength="280"
				class="form-control" 
				id="FormControlTextarea1" 
				placeholder="O que voĉe esta pensando?" 
				required
					rows="3">
			</textarea>
			<button type="button" class="btn btn-outline-success btn-sm mt-2" @click="save">Publicar</button>
			<hr>
			<table class="table table-striped table-lg">
				<thead>
						<tr>
							<th>Comentários</th>
						</tr>
				</thead>
				<tbody v-if="posts">
						<tr v-for="(post, key) in posts" :key="key">
							<td>{{ post.comments }}</td>
							<td>{{ post.users?.name }}</td>
							<td>{{ format_date(post.created_at) }}</td>
							<button v-if="post.user_id == this.$store.state.user.id" @click="confirmDeletePost(post.id, this.$store.state.user.name)" class="btn btn-danger btn-sm">
									Excluir
							</button>
							<button v-if="post.user_id == this.$store.state.user.id" @click="edit({id: post.id})" class="btn btn-primary btn-sm">
								Editar
							</button>
						</tr>
					</tbody>
			</table>
	</div>
</div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
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
		this.$store.commit('getUser')
		this.getAllPosts()
	},
	methods: {
		format_date(value){
         if (value) {
           return moment(String(value)).format('DD/MM/YYYY')
          }
      	},
		  confirmDeletePost(id, name) {
			swal({
					title: "Deseja excluir esse comentário?",
					text: `Tem certeza? Você não conseguirá reverter essa ação, ${name}!`,
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Sim, exclua-o!",
					cancelButtonText: "Não, cancele por favor!",
					closeOnConfirm: false,
  					closeOnCancel: false
					})
					.then( () => {
					let url = route('api.posts.delete')
					let token = this.$store.state.userToken || localStorage.getItem('token');	
					axios.delete(url, {
						headers: { Authorization: 'Bearer ' + token },
						data: {
							id:id
						},
					}).then(response =>{
						if(response){
							swal(
                            'Excluido com sucesso',
                            'success'
							)
							this.getAllPosts()
						}
					}).catch(error => {
						swal(
                        'Não foi possivel excluir!!',
                        'error'
                    )
						console.log(error)
					});
				})
				
		},
		getAllPosts(){
			let url = route('api.posts.index')
			let token = this.$store.state.userToken || localStorage.getItem('token');
			axios.get(url, 
			{ headers: { Authorization: 'Bearer ' + token } }
			).then(response =>{
				this.posts = response.data.data;	
			}).catch(error => {
				console.log(error)
			});
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
		save(){
			let url = route('api.posts.store')
			let token = this.$store.state.userToken || localStorage.getItem('token');
			axios.post(
				url,
				{comments: this.newComments},
				{ headers: { Authorization: 'Bearer ' + token } },
			).then(response => {
				const apiresponse = response.data
				if(apiresponse){
					alert('Comentário criado com sucesso!')
					window.location.reload(true)
				}
			})
		},
		edit(id){
			let url = route('api.posts.edit', {id: id})
			console.log('url',id);
			let token = this.$store.state.userToken || localStorage.getItem('token');
			axios.get(
				url,
				{ headers: { Authorization: 'Bearer ' + token } },
			).then(response => {
				const apiresponse = response.data
				if(apiresponse){
					this.$store.commit('setUserToken', apiresponse.access_token)
					localStorage.setItem('idPost', apiresponse.id)
					this.$router.replace({ name: "edit" })
				}
			})
		},
	},
}
</script>