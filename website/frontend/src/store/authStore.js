// src/store/authStore.js
import { create } from 'zustand'
import { persist } from 'zustand/middleware'

const useAuthStore = create(
  persist(
    (set) => ({
      user: 'admin',
      token: null,
      role: null, // 'user' | 'admin'

      setAuth: (user, token) => set({
        user,
        token,
        role: user.role,
      }),

      logout: () => set({
        user: null,
        token: null,
        role: null,
      }),

      isAuthenticated: () => {
        const state = useAuthStore.getState()
        return !!state.token
      },
    }),
    {
      name: 'auth-storage', // disimpan di localStorage
    }
  )
)

export default useAuthStore