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
                    <tr v-for="user in users.data" :key="user.id">
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
              <div class="card-footer">
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>


          <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Gift this Person some cash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" @submit.prevent="updateUser()">
                    <div class="modal-body">
                    
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name"
                                        placeholder="Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" disabled>
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.email" type="text" name="email"
                                        placeholder="Email"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" disabled>
                                    <has-error :form="form" field="email"></has-error>
                                </div>   


                                  <div class="form-group">
                                    <input v-model="form.current_balance" type="hidden" name="current_balance"
                                        placeholder="Current Balance"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('current_balance') }" disabled>
                                    <has-error :form="form" field="current_balance"></has-error>
                                </div>    


                                   <div class="form-group">
                                    <input v-model="funds" type="number" name="funds" class="form-control"  placeholder="Enter Amount You intent Giving out Here" >
                                   
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
            profile :{},
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
          getResults(page = 1) {
            axios.get('api/user?page=' + page)
              .then(response => {
                this.users = response.data;
              });
          },
          getProfile(){  //this method get your profile details
                axios.get("/profiledetail").then(({ data }) => (this.profile = data))
            },
          loadUsers(){   //this methos loads all system users
          this.$Progress.start()
                axios.get('api/user')
                  .then(({ data }) => (this.users = data))
                  .catch({
                    
                  })
          this.$Progress.finish()
            },

             editModal(user){ //this method displays the modal for fund transfer
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show')
                this.form.fill(user)
            },

             updateUser(){  //This Method Funds a Freind 

              this.$Progress.start()

                let bal = parseFloat(this.form.current_balance) + parseFloat(this.funds); //Add Friend Cur_bal and Fund to be transfered
                let new_bal = this.form.current_balance = bal; //assigns the friend total bal to form to be updated
                
                if(this.profile.current_balance < this.funds){ //checks if the fund you are about to transfer is greater that your current_bal
                  alert('Invalid Figure');

                }else{
                    this.form.put('api/user/'+this.form.id)
                      .then(() => {  
                        $('#addNew').modal('hide') //closes modal on funds transfer  

                          toast.fire({  //dislays success of funds transfer --sweeetalert
                          type: 'success',
                          title: 'Funds Transfered Succesfully'
                        })

                        Fire.$emit('fundTransfer') //create an Event Listening cale fundTransfer
                      })
                    .catch(() => {
                    
                    })
                }
               
                
              this.$Progress.finish()
            }
        },

         created(){  //this method load some method required on component creation

             Fire.$on('searching',() => { //Event Listenings ..Listen to event 'searching' and perform an action 

                   let query = this.$parent.search;   //accessing the parent data (app.js) .i.e the serachTerm
                   axios.get('api/findUser?q=' + query)
                        .then(( data ) => {
                          this.users = data.data
                          })
                        .catch({
                    
                        })
            });

              this.getProfile(); 
              this.loadUsers();

               Fire.$on('fundTransfer',() => { //Event Listenings ..Listen to event 'fundTransfer' and perform an action 
                this.loadUsers();
            });
              
            }

    }
</script>
