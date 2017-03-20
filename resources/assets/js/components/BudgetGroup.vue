<template>
    <div class="panel panel-default budget-group"
         :class="{editing: true == editing}">
        <div class="panel-heading">
            <label @dblclick="editing = true">{{group.name}}</label>
            <input type="text"
                   v-on:blur="editGroup(group.id)"
                   v-model="group.name">
            <i class="fa fa-times pull-right"
               aria-hidden="true"
               @click="deleteGroup(group)"></i>
        </div>
        <div class="panel-body">
            <table class="table" v-for="item in items">
                <item :item="item"></item>
            </table>
            <button data-toggle="modal" data-target="#addBudgetItemModal">
                Add Item <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</template>

<script>
    import BudgetItem from './BudgetItem.vue'

    export default {
        props: [
            'group'
        ],
        components: {
            'item': BudgetItem
        },
        data() {
            return {
                status: null,
                editing: false,
                items: {}
            }
        },
        computed: {},
        mounted: function() {
            this.getItems();
        },
        methods: {
            editGroup: function (id) {
                let vm = this;
                this.editing = false;
                axios.patch('/budget_groups/' + id, vm.group)
                    .then(function (res) {
                        console.log(res);
                    }).catch(function (err) {
                    console.log(err);
                });

            },
            deleteGroup: function (group) {
                let vm = this;

                axios.delete('/budget_groups/' + group.id, {
                    method: 'delete'
                })
                    .then(function (res) {
                        console.log(res);
                    }).catch(function (err) {
                    console.log(err);
                });
            },
            getItems: function () {
                let vm = this;

                axios.get('/budget_items')
                    .then(function (res) {
                        console.log(res);
                        vm.items = res.data.budgetItems || {};

                    }).catch(function (err) {

                });
            }
        }
    }
</script>
