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
                <draggable v-model="items" :options="{group:'items'}" :element="'tbody'" @start="drag=true" @end="drag=false" v-if="!loading">
                    <item v-for="item in items"
                          :item="item"
                          @item-destroy="getItems()" @item-update="updateTotal"></item>
                </draggable>
                <div v-else>
                  Loading...
                </div>
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
            items: [],
            loading: true
        }
    },
    watch: {
        items (newItems) {
            for(var i = 0; i < newItems.length; i++) {

                // if order is updated update those items
                if (newItems[i].order !== i) {
                    this.updateItem(newItems[i]);
                    // console.log(newItems[i]);
                }
                newItems[i].order = i;

            }

        }

    },
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
                    vm.loading = false;
                }).catch(function (err) {
                    console.log(err);
                });
        },
        addItem(groupId) {
            let newItem = {
                groupId: groupId,
                name: 'Label',
                amount: 0,
                type: this.group.type,
                note: null,
                interest: 0,
                date: new Date().toISOString().slice(0, 19).replace('T', ' ')
            };

            let vm = this;

            axios.post('/budget_items/', newItem)
              .then(function (res) {
                newItem.id = res.data.id;
                vm.items.push(newItem);
            }).catch(function (err) {
                console.log(err);
            });
        },
        updateTotal() {
            this.$emit('update');
        },
        updateItem(item) {
            let vm = this;

            item.amount = parseFloat(item.amount) || 0;

            item.note = item.note || '';
            
            axios.patch('budget_items/' + item.id, item
            ).then(res => {
                vm.$emit('item-update');
            }).catch(err => {
                console.log(err);
            });
        }


    }
}
</script>
