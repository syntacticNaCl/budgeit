<template>

    <div class="panel-body budgets">
        <ul class="list-group">
            <li class="list-group-item" v-for="budget in budgets" v-if="budgets.length > 0">
              <budget :budget="budget"></budget>
            </li>
        </ul>
    </div>

</template>

<script>
  import Budget from './Budget.vue';

    export default {
        components: {
            'budget': Budget
        },
        data () {
            return {
                user: {},
                budgets: null,
                categories: null,
            }
        },
        mounted: function () {
            this.getBudgets();
        },
        methods: {
            getBudgets: function () {
                let vm = this;
                axios.get('/api/budget')
                    .then(function (res) {
                        vm.budgets = res.data.budgets;
                        vm.categories = res.data.categories;
                    }).catch(function (err) {

                })
            }
        }
    }
</script>
