<template>
    <div class="budget-groups">
    
        <div class="budget-group-wrapper" v-for="group in groups" v-if="groups.length > 0" :track-by="group.order">
    
            <budget-group :group="group" @group-delete="getBudgetGroups"></budget-group>
    
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
                groups: {}
            }
        },
        mounted() {
            this.getBudgetGroups();
        },
        methods: {
            getBudgetGroups() {
                let vm = this;
                axios.get('/budget_groups')
                    .then(function(res) {
                        vm.groups = res.data;
                    }).catch(function(err) {
                        console.log(err);
                    })
            }
        }
    }
</script>
