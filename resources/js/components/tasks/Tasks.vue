<template>
<div id="app">
    <tbody>
                    <tr v-for="task in tasks" :key="task.user_id">
                      <td>{{task.title}}</td>
                    </tr>
    </tbody>
</div>
  
</template>

<script>
export default {
    data () {
        return {
            tasks : [],
        }
    },
    methods : {
        loadUsers(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/task").then(({ data }) => (this.tasks = data.data));
                }
            }
    },
    created(){
        this.loadUsers();   
    },

}
</script>

<style>

</style>