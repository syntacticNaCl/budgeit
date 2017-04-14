<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-push-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>
                            Income
                        </h3>
                        <p>
                            ${{overview.incomeTotal}}
                        </p>
                        <h3>
                            Expenses
                        </h3>
                        <p>
                            ${{overview.expenseTotal}}
                        </p>
    
                        <h3>
                            Remaining:
                        </h3>
    
                        <p>
                            ${{overview.amountRemaining}}
                        </p>
    
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-md-pull-4">
                <div class="panel-heading">Budget
                    <button class="btn btn-default pull-right"
                            data-toggle="modal"
                            data-target="#addBudgetGroupModal"
                            id="add_budget_group">Create Budget Group</button>
                </div>
                <div class="budget-groups">
    
                    <div class="budget-group-wrapper"
                         v-for="group in groups"
                         v-if="groups.length > 0"
                         :track-by="group.order">
    
                        <budget-group :group="group"
                                      @group-destroy="getBudgetGroups"
                                      @update="getOverview"></budget-group>
    
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BudgetGroup from './BudgetGroup.vue'

export default {
    components: {
        'budget-group': BudgetGroup
    },
    data() {
        return {
            groups: {},
            overview: {}
        }
    },
    mounted() {
        this.getBudgetGroups();
        this.getOverview();
    },
    methods: {
        getBudgetGroups() {
            let vm = this;
            axios.get('/budget_groups')
                .then(function (res) {
                    vm.groups = res.data;
                }).catch(function (err) {
                    console.log(err);
                })
        },
        getOverview() {
            let vm = this;

            axios.get('/budget_overview/')
                .then(function (res) {
                    vm.overview = res.data || {};
                }).catch(function (err) {
                    console.log(err);
                });
        }
    }
}
</script>
