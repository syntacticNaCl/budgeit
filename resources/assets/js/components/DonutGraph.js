import {Doughnut} from 'vue-chartjs'

export default Doughnut.extend({
    props: [
        "groups", "groupData"
    ],
    data () {
        return {}
    },
    watch: {},
    mounted () {
        this.renderChart(this.groupData);
    }

})
