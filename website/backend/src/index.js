import express from 'express'
import cors from 'cors'
import dotenv from 'dotenv'

dotenv.config()

const app = express()
const PORT = process.env.PORT || 3000

// middleware
app.use(cors())
app.use(express.json())

// route test
app.get('/', (req, res) => {
  res.send('API is running 🚀')
})

// contoh route login dummy
app.post('/api/login', (req, res) => {
  const { email, password } = req.body

  // dummy logic
  if (email === 'admin@mail.com' && password === '123456') {
    return res.json({
      user: {
        id: 1,
        email,
        role: 'admin',
      },
      token: 'dummy-token-123',
    })
  }

  res.status(401).json({ message: 'Invalid credentials' })
})

// start server
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`)
})