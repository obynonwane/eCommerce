<template>
    <div class="container">
          <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Your Deposits Histories</h3>

                <div class="card-tools">
                    
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Currency</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Domain</th>
                      <th>Reference_id</th>
                      <th>Response</th>
                      <th>Payment Date</th>
                      <th>Payment Method</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="deposit in deposits" :key="deposit.id">
                      <td>{{deposit.id}}</td>
                      <td>{{deposit.currency}}</td>
                      <td>{{deposit.amount}}</td>
                      <td>{{deposit.status}}</td>
                      <td>{{deposit.domain}}</td> 
                      <td>{{deposit.reference}}</td>               
                      <td>{{deposit.gateway_response}}</td>
                      <td>{{deposit.paid_at|myDate}}</td>
                      <td>{{deposit.payment_method}}</td>                     
                    </tr>
                   
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
          return {
             deposits : {},
          }
        },

        methods:{

            loadDeposits() {
                axios.get("/deposits").then(({ data }) => (this.deposits = data))
            },
            
        },

         created(){
              this.loadDeposits();
            }

    }
</script>
