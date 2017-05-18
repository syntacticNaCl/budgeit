<template>
    <div class="overview-wrapper">
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
        <donut-graph :groups="groups" :groupData="typeData" v-if="!loading"></donut-graph>
        <donut-graph :groups="groups" :groupData="groupData" v-if="!loading"></donut-graph>
        <div v-else>
            loading...
        </div>
    </div>
</template>

<script>
  import DonutGraph from './DonutGraph'

    export default {
        components: {
            DonutGraph
        },
        data () {
            return {
                groups: {},
                overview: {},
                loading: true,
                groupData: {
                    labels: [],
                    datasets: [
                        {
                            data: [],
                            backgroundColor: [
                                "#4BC0C0",
                                "#36A2EB",
                                "#FFCE56",
                                "#4BC0C0",
                                "#36A2EB",
                                "#FFCE56",
                                "#4BC0C0",
                                "#36A2EB",
                                "#FFCE56"
                            ],
                            hoverBackgroundColor: [
                                "#4BC0C0",
                                "#36A2EB",
                                "#FFCE56",
                                "#4BC0C0",
                                "#36A2EB",
                                "#FFCE56",
                                "#4BC0C0",
                                "#36A2EB",
                                "#FFCE56"
                            ]
                        }]
                },
                typeData: {
                    labels: [
                        "Income",
                        "Expense",
                        "Debt"
                    ],
                    datasets: [
                        {
                            data: [],
                            backgroundColor: [
                                "#4BC0C0",
                                "#FF6384",
                                "#FFCE56"
                            ],
                            hoverBackgroundColor: [
                                "#4BC0C0",
                                "#FF6384",
                                "#FFCE56"
                            ]
                        }]
                }
            }
        },
        mounted () {
            this.getBudgetGroups();
            this.getOverview();
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
                        let overview = res.data || {};
                        vm.overview = overview;
                        vm.typeData.datasets[0].data.push(overview.incomeTotal);
                        vm.typeData.datasets[0].data.push(overview.expenseTotal);
                        vm.typeData.datasets[0].data.push(overview.debtTotal);

                        for (let i = 0; i < overview.groupAmounts.length; i++) {
                            let group = overview.groupAmounts[i];
                            vm.groupData.labels.push(group.name);
                            vm.groupData.datasets[0].data.push(group.amount)
                        }
                        setTimeout(function(){
                            vm.loading = false;
                        }, 300);
                    }).catch(function (err) {
                    console.log(err);
                });
            },
        }
    }
</script>
