<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">{{ filter.name }}</h3>

        <div class="p-2">
            <select
                    ref="select2_filter"
                    :dusk="filter.name + '-filter-select'"
                    class="block w-full form-control-sm form-select"
                    v-model="value"
            >
                <slot></slot>
            </select>
        </div>
    </div>
</template>

<script>
  import 'select2/dist/js/select2.full.min'

  export default {
    props: {
      resourceName: {
        type: String,
        required: true,
      },
      filterKey: {
        type: String,
        required: true,
      },
    },
    data() {
      return {
        config: {
          data: null,
        },
        value: '',
      }
    },
    methods: {
      handleChange(value) {
        value = parseInt(value)

        if (this.config.multiple) {
          const foo = this.value.indexOf(value)

          if (this.value.indexOf(value) === -1) {     // the value isn't yet part of this.value
            this.value.push(value)                 // pushing the value to value object
          } else {
            this.value.splice(foo, 1)              // removing it
          }
          if (this.value.length <= 0) {
            this.$store.commit(`${this.resourceName}/updateFilterState`, {
              filterClass: this.filterKey,
              value: '',
            })
          } else {
            this.$store.commit(`${this.resourceName}/updateFilterState`, {
              filterClass: this.filterKey,
              value: this.value,
            })
          }
        } else {
          this.value = value;

          this.$store.commit(`${this.resourceName}/updateFilterState`, {
            filterClass: this.filterKey,
            value: this.value,
          })
        }
        this.$emit('change')
      },
      setDefaultValues() {
        let data = []
        let config = this.filter.config

        this.filter.options.forEach((element) => {
          data.push({'id': element.name, 'text': element.value})
        })

        config.data = data
        this.config = config

        this.value = this.config.multiple ? Array.isArray(this.filter.currentValue) ? this.filter.currentValue : [] : this.value.currentValue;
      },
      initSelect2() {
        const filter = $(this.$refs.select2_filter)

        this.setDefaultValues()

        filter.select2(this.config)
          .val(this.filter.currentValue).trigger('change')        // setting default value
          .on('select2:select', e => {
            this.handleChange(e.params.data.id)
          })
          .on('select2:unselect', e => {
            if (this.config.multiple) {                         // delete unselected value
              this.handleChange(e.params.data.id)
            } else {                                            // clear all values
              this.$store.commit(`${this.resourceName}/updateFilterState`, {
                filterClass: this.filterKey,
                value: '',
              })
            }
          })
      }
    },

    computed: {
      filter() {
        return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey)
      },
    },
    mounted() {
      this.initSelect2()
    }
  }
</script>
