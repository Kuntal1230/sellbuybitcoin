
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('message', require('./components/ChatMessage.vue'));
// Vue.component('send-message', require('./components/ChatForm.vue'));

const app = new Vue({
    el: '#vue_id',
    data: {
        errors:'',
        amount_fiat:null,
        amount_btc:null,
        min_ammount:parseFloat($('#min_ammount').html()),
        max_ammount:parseFloat($('#max_ammount').html()),
        rates:parseFloat($('#custom_rate').val()),
        margin:$('#margin').val(),
        youget:'',
        hasError: false,
        disabled:false,
        color:'red',
        display:'none',
        Yougotdisplay:'none',
        typing:'',
        groupId:'',
        groupName:$('#reciverid').val()+$('#senderid').val(),
        groupUsers:[],        
        reciverId : $('#reciverid').val(),
        senderId: $('#senderid').val(),
        
      },
      
      methods: {
        check1: function (e) {
            this.hasError=false,
            this.disabled=false,
            this.display='none'
            this.Yougotdisplay='block'
            youget = parseFloat(this.amount_fiat)-((parseFloat(this.amount_fiat)*this.margin)/100)
            this.youget = parseFloat(youget).toFixed(2)
           btc=parseFloat(this.amount_fiat)/this.rates,
           this.amount_btc= parseFloat(btc).toFixed(8)
           if (this.amount_fiat<this.min_ammount||this.amount_fiat>this.max_ammount)
                this.hasError=true,
                this.disabled=true,
                this.display='block',
                this.Yougotdisplay='none'

        },
        check2:function(e){
            this.hasError=false,
            this.disabled=false,
            this.display='none',
            this.Yougotdisplay='block'

            local=this.rates*parseFloat(this.amount_btc)
            this.amount_fiat=parseFloat(local).toFixed(2)
            youget = parseFloat(this.amount_fiat)-((parseFloat(this.amount_fiat)*this.margin)/100)
            this.youget = parseFloat(youget).toFixed(2)
            if (parseFloat(local)<this.min_ammount||parseFloat(local)>this.max_ammount)
                this.hasError=true,
                this.disabled=true,
                this.display='block',
                this.Yougotdisplay='none'
        }
       
    }
});
