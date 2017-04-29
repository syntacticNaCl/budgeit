<template>
    <tr class="budget-item">
        <td :class="{editing: true == editingName}">
            <label @dblclick="editingName = true">{{item.name}}</label>
            <input type="text"
                   v-on:blur="editingName = false; editItem()"
                   v-model="item.name"
                   required>
        </td>
        <td :class="{editing: true == editingAmount}">
            <label @dblclick="editingAmount = true">{{amountString}}</label>
            <input type="text"
                   v-on:blur="editingAmount = false; editItem()"
                   v-model="item.amount"
                   required>
        </td>
        <td>
            <click-confirm>
                <i class="fa fa-times pull-right"
                   aria-hidden="true"
                   @click="deleteItem()"></i>
            </click-confirm>
        </td>
    </tr>
</template>

<script>
const accounting = require('accounting');

export default {
    props: [
        'item'
    ],
    data() {
        return {
            editingName: false,
            editingAmount: false
        }
    },
    computed: {
        amountString() {
            return accounting.formatMoney(this.item.amount);
        }
    },
    methods: {
        editItem() {
            let vm = this;
            this.editingName = false;

            axios.patch('budget_items/' + this.item.id, {
                id: vm.item.id,
                name: vm.item.name,
                amount: parseFloat(vm.item.amount) || 0,
                type: vm.item.type,
                order: vm.item.order
            }).then(res => {
                vm.$emit('item-update');
                vm.$store.commit('setIncomeTotal', vm.item.amount);
            }).catch(err => {
                console.log(err);
            });
        },
        deleteItem() {
            let vm = this;

            axios.delete('budget_items/' + this.item.id)
                .then(function (res) {
                    vm.$emit('item-destroy');
                    console.log(res);
                }).catch(function (err) {
                    console.log(err);
                });
        }
    }
}
</script>
