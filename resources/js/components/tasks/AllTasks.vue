<template>
<div id="app">
   <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Reason</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="task in tasks" :key="task.id">
                      <td>{{ task.id }}</td>
                      <td>{{ task.user.name }}</td>
                      <td>{{ task.created_at | myDate }}</td>
                      <td><span class="tag tag-success">{{ task.status }}</span></td>
                      <td>{{ task.title }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
               <div class="card-footer clearfix">
                <button type="button" @click="newModal" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</button>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <div class="modal" id="addNew" tabindex="-1" role="dialog">
                <div class="col-md-12">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Overzicht Tasks</h5>
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
                                        <!-- <input type="text" name="status" v-model="form.status" placeholder="Status"
                                            class="form-control">
                                        <has-error :form="form" field="Task status"></has-error> -->
                                        <div class="form-group">
                                          <select name="status" v-model="form.status" id="status" class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                              <option value="">Selecteer een gebruikerstype</option>
                                              <option value="open">Open</option>
                                              <option value="in behandeling">In behandeling</option>
                                              <option value="voltooid">Voltooid</option>
                                          </select>
                                          <has-error :form="form" field="status"></has-error>
                                        </div>
                                         <div class="form-group">
                                          <select name="status"  v-model="form.user_id" id="status" class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                              <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                                          </select>
                                          <has-error :form="form" field="status"></has-error>
                                        </div>
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
                    status: '',
                }),
            tasks : [],
            users: {},
        }
    },
    methods : {
        loadTasks(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/allTasks").then(({ data }) => (this.tasks = data.data));
                }
            },
        newModal() {
                // this.editmode = false;
                // this.form.reset();
                $('#addNew').modal('show')

            },
        createTask(){
                this.$Progress.start()
                this.form.post('api/task', {title: '', status: ''})
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
            },
            loadUsers(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/user").then(({ data }) => (this.users = data.data));
                }
            }
            
    },
    created(){
        this.loadTasks();  
        this.loadUsers(); 
    },

}
</script>

<style>

</style>