<template>	

    <div class="panel panel-default">
      <div class="panel-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Date Created</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Message</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer, index in customers">
            <td> {{ customer.created_at}} </td>
            <td> {{ customer.first_name}} </td>
            <td> {{ customer.last_name}} </td>
            <td> {{ customer.message}} </td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="panel-footer">
          <router-link :to="{path: '/'}">
                <button class="btn btn-primary"> Go back </button>
          </router-link>
      </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                customers: []
            }
        },
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.id = id;

            axios.get('/api/v1/customer/' + id)
                .then(function (resp) {
                    app.customers = resp.data;
                    console.log(app.customers)
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load customer");
                });
        }
    }
</script>