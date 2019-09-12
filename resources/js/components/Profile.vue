<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="profile-card card-header">This is your Profile Details</div>

                    <div class="card-body">
                        Name:  {{profile.name}} 
                        <br>
                        Email: {{profile.email}}
                        <br>
                        Joined: {{profile.created_at|myDate}}
                        <br>
                        Account Balance: {{profile.current_balance}}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        //name:"contactShow",

        mounted() {
            console.log('Component mounted.')
        },

     data(){
          return{
            
            profile :{},
            
          }
        },

        methods:{

            getProfile(){
                axios.get("/profiledetail").then(({ data }) => (this.profile = data))
            }
        },

        created(){
              this.getProfile();
            }
    }
</script>
