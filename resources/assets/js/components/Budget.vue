<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-push-8">
                <div class="panel panel-default budget-side">
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
                <div class="budget-groups">
                    <draggable v-model="groups" @start="drag=true" @end="drag=false" v-if="!loading">
                        <div class="budget-group-wrapper"
                            v-for="group in groups"
                            v-if="groups.length > 0"
                            :track-by="group.order" :key="group.id">

                            <budget-group :group="group"
                                   @group-destroy="getBudgetGroups"
                                          @update="getOverview"></budget-group>

                        </div>
                    </draggable>

                    <div v-else>
                      Loading...
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
            groups: [],
            overview: {},
            loading: true
        }
    },
    mounted() {
        this.getBudgetGroups();
        this.getOverview();
    },
    watch: {
        groups (newGroups) {
            for(var i = 0; i < newGroups.length; i++) {

                // if order is updated update those groups
                if (newGroups[i].order !== i) {
                    this.updateGroup(newGroups[i]);
                }
                newGroups[i].order = i;

            }

        }
    },
    methods: {
        getBudgetGroups() {
            let vm = this;
            axios.get('/budget_groups')
                .then(function (res) {
                    vm.groups = res.data;


                    vm.loading = false;


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
        },
        updateGroup(group) {
            let vm = this;

            axios.patch('/budget_groups/' + group.id, group)
                .then(res => {
                    vm.$emit('group-update');
                }).catch(err => {
                    console.log(err);
                });

        }
    }
}
</script>
