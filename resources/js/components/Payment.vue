<template>
    <paystack
        :amount="amount"
        :email="email"
        :paystackkey="paystackkey"
        :reference="reference"
        :callback="callback"
        :close="close"
        :embed="false"
    >
       <i class="fas fa-money-bill-alt"></i>
       Make Payment
    </paystack>
</template>

<script type="text/javascript">
import paystack from 'vue-paystack';
export default {
    components: {
        paystack
    },
    data(){
        return{
          paystackkey: "pk_test_be5884972315ed44393952016feea3db7331ca21", //paystack public key
          email: "biostechnologyng@gmail.com", // Customer email
          amount: 1000000 // in kobo
        }
    },
    computed: {
      reference(){
        let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for( let i=0; i < 10; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
      }
    },
    methods: {
      callback: function(response){
        console.log(response)
      },
      close: function(){
          console.log("Payment closed")
      }
    }
}
</script>