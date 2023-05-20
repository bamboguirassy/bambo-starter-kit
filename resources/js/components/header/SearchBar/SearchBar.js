import axios from "axios"
import { InputSearch, AutoComplete } from 'ant-design-vue';

export default {
  name: 'search-bar',
  components: {
    InputSearch,
    AutoComplete
  },
  props: [],
  data() {
    return {
      searchText: '',
      employes: [],
    }
  },
  computed: {

  },
  mounted() {
  },
  methods: {
    handleSearch() {
      if (this.searchText.length > 2) {
        this.searchEmploye();
      }
    },
    searchEmploye() {
      axios.post('/search-employe', { searchText: this.searchText }).then((result) => {
        let response = result.data;
        if (response.error) {
          if (response.validation_error) {
            response.errors.forEach(error => {
              alert(error);
            });
          } else {
            alert(response.error_message);
          }
        } else {
          this.employes = response.employes;
        }
      });
    }
  }
}


