<template>
	
    <h1 class="">Dashboard</h1>
	<div>
		<table>
			<thead>
                    <tr>
                        <th>ID</th>
                        <th>Commentds</th>
                        <th>User_id</th>
                    </tr>
            </thead>
			<tbody>
                    <tr v-for="(post, key) in posts" :key="key">
                        <td>{{ post.id }}</td>
                        <td>{{ post.comments }}</td>
                        <td>{{ post.user_id }}</td>
                    </tr>
                </tbody>
		</table>

	</div>
   
</template>

<script>
import axios from 'axios';
import { route } from 'ziggy-js';

export default {
    data(){
        return{
			posts:[],
		}
    },
	created(){
		this.getAllPosts()
	},
	methods: {
		getAllPosts(){
			let url = route('api.posts.index')
			let token = this.$store.state.userToken;
			axios.get(url, 
			{ headers: { Authorization: 'Bearer ' + token } }
			).then(response =>{
				this.posts = response.data.data;	
				console.log('posts', this.posts)
			}).catch(error => {
				console.log(error)
			});
		}
	},
}
</script>