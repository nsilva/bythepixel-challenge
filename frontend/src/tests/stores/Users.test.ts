import { describe, it, beforeEach, expect } from "vitest"
import { setActivePinia, createPinia } from 'pinia'
import { useUsers } from '@/stores/users'

describe('Counter Store', () => {
  beforeEach(() => {
    // creates a fresh pinia and make it active so it's automatically picked
    // up by any useStore() call without having to pass it to it:
    // `useStore(pinia)`
    setActivePinia(createPinia())
  })

  it('fetches users', async () => {
    const users = useUsers()
    expect(users.usersList).toBe(null)
    await users.fetchUsers()
    expect(users.usersList).toBeTypeOf("object")

    const weatherData = JSON.stringify(users.usersList[0])
    expect(weatherData).toContain('id')
    expect(weatherData).toContain('name')
    expect(weatherData).toContain('temp')
  })
  
  it('fetches weather data', async () => {
    const users = useUsers()
    await users.fetchUsers()

    users.setSelectedUser(users.usersList[0])
    expect(users.selectedUser).toBeTypeOf("object")

    await users.getUserWeather()
    expect(users.selectedUser.weather).toBeTypeOf("object")

    const weatherData = JSON.stringify(users.selectedUser.weather)
    expect(weatherData).toContain('user_id')
    expect(weatherData).toContain('main')
    expect(weatherData).toContain('feels_like')
    expect(weatherData).toContain('temp_max')
    expect(weatherData).toContain('temp_min')
    expect(weatherData).toContain('city')
    expect(weatherData).toContain('country')
  })
  
  it('created error if user not found', async () => {
    const users = useUsers()
    await users.fetchUsers()

    const testUser = users.usersList[0]
    testUser.id = 0
    users.setSelectedUser(testUser)
    
    await users.getUserWeather()
    
    expect(users.serverError).toContain('failed')
  })
})