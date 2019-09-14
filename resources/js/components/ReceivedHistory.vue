<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Received Funds History</div>

                    <div class="card-body">
                         <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Sender</th>
                      <th>Email</th>
                      <th>Amount</th>
                      <th>Received Date</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(trans,index) in transactions" :key="index">
                      <td>{{index = index + 1}}</td>
                      <td>{{trans.name}}</td>
                      <td>{{trans.email}}</td>
                      <td>{{trans.amount_sent}}</td>                   
                      <td>{{trans.created_at | myDate}}</td>
                    </tr>
                   
                  
                  </tbody>
                </table>
                    </div>
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
                transactions:{}

            }
        },

        methods: {

            getTransact(){ //get the histories of sent funds
            this.$Progress.start()
                  axios.get('api/get_received')
                  .then(({ data }) => (this.transactions = data))
                  .catch({
                    
                  })
            this.$Progress.finish()
            }

        },
         created(){  //this method load some method required on component creation
              this.getTransact();               
            }
    }
</script>
