<template>
    <div class="panel panel-default budget-group">
        <div class="panel-heading"
             :class="{editing: true == editing}">
            <click-confirm>
                <label @dblclick="editing = true">{{group.name}}</label>
                <input type="text"
                       v-on:blur="editGroup(group.id)"
                       v-model="group.name">
                <i class="fa fa-times pull-right"
                   aria-hidden="true"
                   @click="deleteGroup(group)"></i>
            </click-confirm>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <item v-for="item in items"
                          :item="item"
                          @item-destroy="getItems()" @item-update="updateTotal"></item>
                </tbody>
            </table>
            <button @click="addItem(group.id)"
                    class="item-add">Add Item</button>
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
            editing: false,
            items: {}
        }
    },
    computed: {},
    mounted() {
        this.getItems();
    },
    methods: {
        editGroup() {
            let vm = this;
            this.editing = false;
            axios.patch('/budget_groups/' + this.group.id, this.group)
                .then(function (res) {
                    vm.$emit('group-update');
                }).catch(function (err) {
                    console.log(err);
                });

        },
        deleteGroup(group) {
            let vm = this;

            axios.delete('/budget_groups/' + this.group.id, {
                method: 'delete'
            })
                .then(function (res) {
                    vm.$emit('group-destroy');
                }).catch(function (err) {
                    console.log(err);
                });
        },
        getItems() {
            let vm = this;

            axios.get('/budget_groups/' + this.group.id + '/items')
                .then(function (res) {
                    vm.items = res.data.items || {};
                }).catch(function (err) {
                    console.log(err);
                });
        },
        addItem(groupId) {
            let newItem = {
                id: null,
                groupId: this.group.id,
                name: 'Label',
                amount: 0,
                type: this.group.type
            };

            let vm = this;

            axios.post('/budget_items/', {
                name: newItem.name,
                amount: newItem.amount,
                type: newItem.type,
                groupId: groupId
            }).then(function (res) {
                newItem.id = res.data.id;
                vm.items.push(newItem);
            }).catch(function (err) {
                console.log(err);
            });
        },
        updateTotal() {
            this.$emit('update');
        }
    }
}
</script>
