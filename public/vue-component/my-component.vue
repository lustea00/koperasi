<script>
export default {
  props: ["surveyData"],
  mounted() {
    // Do something useful with the data in the template
    console.dir(this.surveyData);
  }
};
</script>