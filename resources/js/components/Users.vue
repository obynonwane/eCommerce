<template>
    <div class="container">
          <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Be Kind Enough!.. Gift a friend some cash</h3>

                <div class="card-tools">
                    
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      
                      <th>Joined date</th>
                      <th>Gift Money</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name|upText}}</td>
                      <td>{{user.email}}</td>
                      
                      
                      <td>{{user.created_at | myDate}}</td>
                      <td>
                          <a href="#" @click="editModal(user)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                      </td>
                    </tr>
                   
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


          <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Gift the Person</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" @submit.prevent="updateUser()">
                    <div class="modal-body">
                    
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name"
                                        placeholder="Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" >
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.email" type="text" name="email"
                                        placeholder="Email"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>   


                                  <div class="form-group">
                                    <input v-model="form.current_balance" type="text" name="current_balance"
                                        placeholder="Current Balance"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('current_balance') }">
                                    <has-error :form="form" field="current_balance"></has-error>
                                </div>    


                                   <div class="form-group">
                                    <input v-model="funds" type="text" name="funds" class="form-control"  placeholder="Funds Transfer" >
                                   
                                </div>                        


                    </div>
              
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Gift</button>
                        
                    </div>
                  </form>
                </div>
            </div>
            </div>



    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data(){
          return{
            editmode:false,
            users : {},
            funds:'',
            form:new Form({
                    id:'',
                    name: '',
                    email: '',
                    current_balance: '',
                })
          }
        },

        methods:{
          loadUsers(){
                axios.get("api/user").then(({ data }) => (this.users = data.data))
            },

             editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show')
                this.form.fill(user)
            },

             updateUser(){

                let bal = this.form.current_balance + this.funds;
                let new_bal = this.form.current_balance = bal;
                console.log(new_bal);
                // console.log('Editting Data');
                this.form.put('api/user/'+this.form.id)
                .then(() => {                  
                    
                })
                .catch(() => {
                    
                })
            }
        },

         created(){
              this.loadUsers();
            }

    }
</script>
