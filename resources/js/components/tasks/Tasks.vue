<template>
<div id="app">
<div class="card mt-4">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">«</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">»</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list ui-sortable" data-widget="todo-list">
                  
                  <li class="" v-for="task in tasks" :key="task.user_id">
                    <span class="handle ui-sortable-handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" v-model="task.is_complete" name="todo2" id="todoCheck2" >
                      <label for="todoCheck2"></label>
                    </div>
                    <span class="text">{{task.title}}</span>
                    <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <button type="button" @click="newModal" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</button>
              </div>
            </div>
            <!-- /.Modal Add Task -->
            <div class="modal" id="addNew" tabindex="-1" role="dialog">
                <div class="col-md-12">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Voeg een task toe</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form @submit.prevent="createTask()">
                                 <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="title" v-model="form.title" placeholder="Titel"
                                            class="form-control">
                                        <has-error :form="form" field="Task Title"></has-error>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Maak Task aan</button>
                                    </div>
                                 </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
    </div>



  
</template>

<script>
export default {
    data () {
        return {
            form: new Form({
                    id:'',
                    user_id : '',
                    title: '',
                    description: '',
                    complete: '',
                }),
            tasks : [],
        }
    },
    methods : {
        loadUsers(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/task").then(({ data }) => (this.tasks = data.data));
                }
            },
        newModal() {
                // this.editmode = false;
                // this.form.reset();
                $('#addNew').modal('show')

            },
        createTask(){
                this.$Progress.start()
                this.form.post('api/task', {title: ''})
                .then(() => {
                    Fire.$emit('AfterCreate');

                    $('#addNew').modal('hide')

                    toast.fire({
                        icon: 'success',
                        title: 'Gebruiker is aangemaakt!'
                    })

                    this.$Progress.finish()

                    })
                    .catch(() => {
                        this.$Progress.fail()
                    })
            }
    },
    created(){
        this.loadUsers();   
    },

}
</script>

<style>

</style>