<template>
    <div class="row budget-groups">
        <div class="budget-group" v-for="group in groups" v-if="groups.length > 0" :track-by="group.order">
        
            <budget-group :group="group"></budget-group>

        </div>
    </div>


</template>

<script>

import BudgetGroup from './BudgetGroup.vue'

export default {
    components: {
        'budget-group': BudgetGroup
    },
    data () {
        return {
            user: {},
            groups: {}
        }
    },
    mounted: function () {
        this.getBudgetGroups();
    },
    methods: {
        getBudgetGroups: function () {
            let vm = this;
            axios.get('/budget_groups')
            .then(function (res) {
                vm.groups = res.data.budgetGroups;
                vm.user = res.data.user;
            }).catch(function (err) {

            })
        }
    }
}
</script>
