<template>
	
    <h1 class="">Dashboard</h1>
   
</template>

<script>
import axios from 'axios';
import { route } from 'ziggy-js';

export default {
    data(){
        return{
			routeIndex : route('api.posts.index'),
		}
    },
	created(){
		console.log(this.$store.state)
		this.getAllPosts()
	},
	methods: {
		getAllPosts(){
			axios.get(this.routeIndex, 
			{ headers: { Authorization: 'Bearer ' + this.$store.commit('getUserToken') } }
			).then(response =>{
				const apiresponse = response.data;	
				console.log(apiresponse)
			}).catch(error => {
				console.log(error)
			});
		}
	},
}
</script>