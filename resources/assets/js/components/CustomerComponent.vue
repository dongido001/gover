<template>	
	<div class="row" v-if="customers.length">
  
	<div class="panel panel-default col-xs-6 col-md-3 thumbnail"  v-for="customer, index in customers" >
	  <div class="panel-body">
	      #: {{ customer.messenger_user_id }} <br>
	      No. of Messages: {{ customer.number_of_message }} <br>
	      {{ customer.first_name }} {{ customer.last_name }} <br>
	  </div>
	  <div class="panel-footer">
	  	 <router-link :to="{name: 'CustomerView', params: {id: customer.id} }" class="btn btn-primary">View Detail</router-link>
	  </div>
	</div>

	</div>

	<p v-else>No Message stored yet</p>
</template>

<script>
    export default {
        data: function () {
            return {
                customers: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/customers')
                .then(function (resp) {
                    app.customers = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load customers");
                });
        }
    }
</script>