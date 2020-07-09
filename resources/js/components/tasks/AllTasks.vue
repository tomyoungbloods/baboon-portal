<template>
<div id="app" class="verzoeken">
   <div class="col-lg-12 mt-4">
     <div class="row">
       <h1 class="verzoeken-title col-lg-12">Open Verzoeken</h1>
     </div>
     <div class="row mt-4 baboon-green-bg p-4">
       <div class="d-flex flex-row col-lg-12 verzoeken-header pb-3">
         <div class="col-lg-3">
           Wie pakt het op?
         </div>
         <div class="col-lg-5 col-xs-12">
           Taak
         </div>
         <div class="col-lg-2 col-xs-12">
           Date
         </div>
         <div class="col-lg-1 col-xs-12">
           Status
         </div>
         <div class="col-lg-1 col-xs-12">
           Edit
         </div>
       </div>
       <div v-for="task in openTasks" :key="task.id" class="d-flex flex-row col-lg-12 verzoeken-body">
         <div class="col-lg-3 profile-img">
           <img v-bind:src="'/img/profile/' + task.user.photo" />{{ task.user.name }}
         </div>
         <div class="col-lg-5">
           {{ task.title }}
         </div>
         <div class="col-lg-2 datum">
           {{ task.date | myDate }}
         </div>
         <div class="col-lg-1 status">
           {{ task.status }}
         </div>
         <div class="col-lg-1">
           <a href=# @click="editModal(task)">
              <i class="fa fa-edit baboon"></i>
          </a>
          <a href="#" @click="deleteTask(task.id)">
              <i class="fa fa-trash"></i>
          </a>
         </div>
       </div>

     </div>
   </div>

      <div class="col-lg-12 mt-4">
        <div class="row">
          <h1 class="verzoeken-title col-lg-12">Verzoeken in behandeling</h1>
        </div>
        <div class="row mt-4 baboon-green-bg p-4">
          <div class="d-flex flex-row col-lg-12 verzoeken-header pb-3">
            <div class="col-lg-3">
              Wie pakt het op?
            </div>
            <div class="col-lg-5">
              Taak
            </div>
            <div class="col-lg-2">
              Date
            </div>
            <div class="col-lg-1">
              Status
            </div>
            <div class="col-lg-1">
              Edit
            </div>
          </div>
          <div v-for="task in busyTasks" :key="task.id" class="d-flex flex-row col-lg-12 verzoeken-body">
            <div class="col-lg-3 profile-img">
              <img v-bind:src="'/img/profile/' + task.user.photo" />{{ task.user.name }}
            </div>
            <div class="col-lg-5">
              {{ task.title }}
            </div>
            <div class="col-lg-2 datum">
              {{ task.date | myDate }}
            </div>
            <div class="col-lg-1 status">
              {{ task.status }}
            </div>
            <div class="col-lg-1">
              <a href=# @click="editModal(task)">
                  <i class="fa fa-edit baboon"></i>
              </a>
              <a href="#" @click="deleteTask(task.id)">
                  <i class="fa fa-trash"></i>
              </a>
            </div>
          </div>

        </div>
      </div>

      <div class="col-lg-12 mt-4 mb-4">
        <div class="row">
          <h1 class="verzoeken-title col-lg-12">Voltooide verzoeken</h1>
        </div>
        <div class="row mt-4 baboon-green-bg p-4">
          <div class="d-flex flex-row col-lg-12 verzoeken-header pb-3">
            <div class="col-lg-3">
              Wie pakt het op?
            </div>
            <div class="col-lg-5">
              Taak
            </div>
            <div class="col-lg-2 datum">
              Date
            </div>
            <div class="col-lg-1">
              Status
            </div>
            <div class="col-lg-1">
              Edit
            </div>
          </div>
          <div v-for="task in closedTasks" :key="task.id" class="d-flex flex-row col-lg-12 verzoeken-body">
            <div class="col-lg-3 profile-img">
              <img v-bind:src="'/img/profile/' + task.user.photo" />{{ task.user.name }}
            </div>
            <div class="col-lg-5">
              {{ task.title }}
            </div>
            <div class="col-lg-2">
              {{ task.date | myDate }}
            </div>
            <div class="col-lg-1 status">
              {{ task.status }}
            </div>
            <div class="col-lg-1">
              <a href=# @click="editModal(task)">
                  <i class="fa fa-edit baboon"></i>
              </a>
              <a href="#" @click="deleteTask(task.id)">
                  <i class="fa fa-trash"></i>
              </a>
            </div>
          </div>
        </div>

     </div>
              
   
        <button type="button" @click="newModal" class="add-right-button position-fixed right btn btn-info float-right"><i class="fas fa-plus"></i></button>

    <!-- /.Start-modal -->

          <div class="modal" id="addNew" tabindex="-1" role="dialog">
                <div class="col-lg-md-12">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Overzicht Tasks</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form @submit.prevent="editmode ? updateTask() : createTask()">
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
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                          </div>
                                          <input type="text" v-model="form.date" class="form-control" data-inputmask-alias="datetime" placeholder="yyyy/mm/dd" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                      </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button v-show="editmode" type="submit" class="btn btn-primary">Bewerk</button>
                                        <button v-show="!editmode" type="submit" class="btn btn-primary">Maak gebruiker aan</button>
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
            editmode: false,
            form: new Form({
                    id:'',
                    user_id : '',
                    title: '',
                    description: '',
                    status: '',
                    date: '',
                }),
            tasks : [],
            users: {},
        }
    },
    computed: {
    openTasks() {
      return this.tasks.filter(tasks => tasks.status === "open");
    },
    busyTasks() {
      return this.tasks.filter(tasks => tasks.status === "in behandeling");
    },
    closedTasks() {
      return this.tasks.filter(tasks => tasks.status === "voltooid");
    }
  },
    methods : {

        loadTasks(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/allTasks").then(({ data }) => (this.tasks = data.data));
                }
            },
        newModal() {
                this.editmode = false;
                this.form.reset();
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
            updateTask(){
                this.$Progress.start()
                this.form.put('api/task/'+this.form.id)
                .then(() => {
                    $('#addNew').modal('hide')
                    swal.fire(
                                'Updated!',
                                'De Task aangepast',
                                'success'
                            )
                            this.$Progress.finish()
                            Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail()
                })
            },
            loadUsers(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/user").then(({ data }) => (this.users = data.data));
                }
            },
            editModal(task) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(task);

            },
            deleteTask(id) {
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                        //Send request to the server
                            this.form.delete('api/task/' + id).then(()=>{
                                swal.fire(
                                'Deleted!',
                                'De Task is gewist',
                                'success'
                                    )
                                Fire.$emit('AfterCreate');  
                            })
                        }
                        }).catch(()=> {
                            swal.fire('Oei!', 'Er gaat iets niet helemaal lekker.', 'warning');
                        });

                    

            }
            
    },
    created(){
        this.loadTasks();  
        this.loadUsers(); 

        Fire.$on('AfterCreate',() => {
               this.loadUsers();
               this.loadTasks(); 
           });
    },

}
</script>

<style>

</style>