<template>
    <div class="overview-wrapper">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-4">
                    <h3>
                        Income: ${{overview.incomeTotal}}
                    </h3>
                </div>
                <div class="col-sm-4">
                    <h3>
                        Expenses ${{overview.expenseTotal}}
                    </h3>
                </div>
                <div class="col-sm-4">
                    <h3>
                        Remaining: ${{overview.amountRemaining}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <donut-graph :groups="groups" :groupData="typeData" v-if="!loadingMain"></donut-graph>
            <p v-else>
                loading...
            </p>
        </div>
        <div class="col-sm-12 col-md-6">
            <donut-graph :groups="groups" :groupData="groupData" v-if="!loadingSecondary"></donut-graph>
            <p v-else>
                loading...
            </p>
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
                loadingMain: true,
                loadingSecondary: true,
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
                        setTimeout(function(){
                            vm.loadingMain = false;
                        }, 600);

                        for (let i = 0; i < overview.groupAmounts.length; i++) {
                            let group = overview.groupAmounts[i];
                            vm.groupData.labels.push(group.name);
                            vm.groupData.datasets[0].data.push(group.amount)
                        }
                        setTimeout(function(){
                            vm.loadingSecondary = false;
                        }, 600);
                    }).catch(function (err) {
                    console.log(err);
                });
            },
        }
    }
</script>
