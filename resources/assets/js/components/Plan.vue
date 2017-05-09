<template>
  <div class="fluid container">
      <div class="col-md-4 text-center">
          <h3>Unallocated</h3>
          <draggable element="ul" v-model="unallocated" class="list-group" :options="dragOptions">
            <transition-group type="transition" :name="'flip-list'">
              <li class="list-group-item" v-for="item in unallocated" :key="item.order">
                {{item.name}}
                <span class="badge">{{getDayMonth(item.date)}}</span>
              </li>
            </transition-group>
          </draggable>
      </div>
      <div class="col-md-4 text-center">
          <h3>Allocated</h3>
          <draggable element="ul" v-model="allocated" class="list-group" :options="dragOptions">
            <transition-group type="transition" :name="'flip-list'">
              <li class="list-group-item" v-for="item in allocated" :key="item.order">
                {{item.name}}
                <span class="badge">{{getDayMonth(item.date)}}</span>
              </li>
            </transition-group>
          </draggable>
      </div>
      <div class="col-md-4 text-center">
          <h3>Paid</h3>
          <draggable element="ul" v-model="paid" class="list-group" :options="dragOptions">
            <transition-group type="transition" :name="'flip-list'">
              <li class="list-group-item" v-for="item in paid" :key="item.order">
                {{item.name}}
                <span class="badge">{{getDayMonth(item.date)}}</span>
              </li>
            </transition-group>
          </draggable>
      </div>
  </div>
</template>

<style>
    .list-group {

    }

    .list-group span {
        display: block;
        min-height: 20px;
    }

    .list-group .list-group-item {
        cursor: pointer;
        margin: 10px auto;
        padding: 10px;
    }

    .flip-list-move {
      transition: transform 0.5s;
    }

  .ghost {
      opacity: .5;
      background: #c1e1a6;
   }


</style>

<script>
export default {
  data() {
    return {
        unallocated: [],
        allocated: [],
        paid: [],
        editable: true,
        updateLocked: true
    }
  },
  computed: {
      dragOptions () {
          return  {
              animation: 0,
              group: 'plans',
              disabled: !this.editable,
              ghostClass: 'ghost'
          }
      }
  },
  watch: {
      unallocated (newPlan, oldPlan) {
          if (this.updateLocked) {
              return;
          }
          for (let i = 0; i < newPlan.length; i++) {
              if (oldPlan.length === 0 || newPlan[i].status !== oldPlan[i].status) {
                  newPlan[i].status = 'unallocated';
                  this.updatePlan(newPlan[i]);
              }
          }
          
      },
      allocated (newPlan, oldPlan) {
          if (this.updateLocked) {
              return;
          }
          for (let i = 0; i < newPlan.length; i++) {
              if (oldPlan.length === 0 || newPlan[i].status !== oldPlan[i].status) {
                  newPlan[i].status = 'allocated';
                  this.updatePlan(newPlan[i]);
              }
          }
      },
      paid (newPlan, oldPlan) {
          if (this.updateLocked) {
              return;
          }
          for (let i = 0; i < newPlan.length; i++) {
              if (oldPlan.length === 0 || newPlan[i].status !== oldPlan[i].status) {
                  newPlan[i].status = 'paid';
                  this.updatePlan(newPlan[i]);
              }
          }
      }

  },
  mounted () {
    this.getPlans();
  },
  methods: {
      getPlans () {
          let vm = this;

          axios.get('/budget_plan/')
              .then(function (res) {
                  vm.allocated = res.data.allocated || [];
                  vm.unallocated = res.data.unallocated || [];
                  vm.paid = res.data.paid || [];

                  // ensure no update until plans are retrieved
                  setTimeout(() => {
                      vm.updateLocked = false;
                  }, 300);
                 
              }).catch(function (err) {
                  console.log(err);
              });
      },
      updatePlan (item) {
        let vm = this;

          axios.patch('budget_items/' + item.id, item)
              .then(res => {
            }).catch(err => {
                console.log(err);
            });
      },
      getDayMonth(date) {
          let dateObj = new Date(date);
          let day = dateObj.getDate();
          let month = dateObj.getMonth() + 1;
          return month + '/' + day;
      }
  }

}
</script>
