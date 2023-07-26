/**
 * @vitest-environment happy-dom
 */
import { describe, it, beforeEach, expect } from "vitest"
import { mount } from "@vue/test-utils"
import WeatherModal from "@/components/modals/WeatherModal.vue";

const weather = {
  id: 161,
  user_id: 1,
  main: "Clear",
  description: "clear sky",
  temp: 65.12,
  feels_like: 64.67,
  temp_max: 65.12,
  temp_min: 65.12,
  humidity: 71,
  wind_speed: 12.64,
  wind_degree: 54,
  clouds: 2,
  rain: null,
  snow: null,
  country: "US",
  city: "Los Angeles"
}

const wrapper = mount(WeatherModal, {
  propsData: {weather}
})

describe("User card test", () => {
  it("should render", () => {
    expect(wrapper.find("#header").exists()).toBeTruthy()
    expect(wrapper.find("#temp_location").exists()).toBeTruthy()
    expect(wrapper.find("#description").exists()).toBeTruthy()
    expect(wrapper.find("#temp_min").exists()).toBeTruthy()
    expect(wrapper.find("#temp_max").exists()).toBeTruthy()
    expect(wrapper.find("#feels_like").exists()).toBeTruthy()
    expect(wrapper.find("#humidity").exists()).toBeTruthy()
    expect(wrapper.find("#clouds").exists()).toBeTruthy()
    expect(wrapper.find("#wind").exists()).toBeTruthy()
  })
  
  it("should emit", async () => {
    await wrapper.find('.close-modal').trigger('click')
    wrapper.vm.$nextTick(() => {
      wrapper.vm.handleModalClose()
      expect(wrapper.emitted('modalClosed')).toBeTruthy()
    })
  })
  
})


