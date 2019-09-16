<style>
    .widget-user-header{
        background-position: center center;
        background-size: counter-reset;
        height: 250px;
    }
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
               
                    
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/user-cover.jpg'); background-repeat:repeat; background-size:auto;">
                
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">N{{form.current_balance}}</h5>
                      <span class="description-text">CURRENT WALLET BALANCE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">N13,000</h5>
                      <span class="description-text">TOTAL AMOUNT SENT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">N35</h5>
                      <span class="description-text">TOTAL AMOUNT RECEIVED</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
           </div>
        </div>

        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane " id="activity">
                     <h1>Settings</h1>
                  </div>
                 

                  <div class="tab-pane active" id="settings">
                      <h1>User Profile Info</h1>
                    <form class="form-horizontal">
                    

                     <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                         <div class="col-sm-12">
                            <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name">
                         </div>
                    </div>



                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                          <div class="col-sm-12">
                            <input type="email"  v-model="form.email" class="form-control" id="inputEmail" placeholder="Email" >
                            
                        </div>
                    </div>

                                      
                      <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>

                        <div class="col-sm-12">
                          <input type="file" name="photo" class="form-input">
                        </div>
                      </div>
                   
                      

                      

                    

                     

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form:new Form({
                    id:'',
                    name: '',
                    email: '',
                    current_balance: '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        created(){
            axios.get("api/profile")
            .then(({data}) => (this.form.fill(data)))
            .catch({
                
            })
        }
    }
</script>
