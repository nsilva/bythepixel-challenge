/**
 * @vitest-environment happy-dom
 */
import { describe, it, beforeEach, expect } from "vitest"
import { mount } from "@vue/test-utils"
import UserCard from "@/components/UserCard.vue";

const user = {
  id: 1,
  name: "Richmond Crooks DVM",
  temp: 63.91
}

const wrapper = mount(UserCard, {
  propsData: {user}
})

describe("User card test", () => {
  it("should render", () => {
    expect(wrapper.find("h5").exists()).toBeTruthy()
    expect(wrapper.find("h5").text()).toBe(user.name)
    expect(wrapper.find("a").exists()).toBeTruthy()
  })
  
  it("should emit", async () => {
    await wrapper.find('a').trigger('click')
    wrapper.vm.$nextTick(() => {
      wrapper.vm.handleUserSelect()
      expect(wrapper.emitted('userSelected')).toBeTruthy()
    })
  })
})


