import React from 'react'
import { createRoot } from 'react-dom/client'

function App() {
  const [data, setData] = React.useState(null)

  React.useEffect(() => {
    // Basic fetch to demonstrate API connectivity
    fetch('/api/weather/forecast?lat=7.4467&lon=125.8094')
      .then(res => res.json())
      .then(d => setData(d))
      .catch(() => setData({ error: 'Unable to fetch weather data' }))
  }, [])

  return (
    <div style={{ padding: '1rem' }}>
      <h1 style={{ fontFamily: 'Inter, ui-sans-serif, system-ui', fontWeight: 700 }}>Laravel + React</h1>
      <p style={{ fontFamily: 'Inter, ui-sans-serif, system-ui' }}>
        This is a minimal React frontend connected to the Laravel backend.
      </p>
      <div style={{ marginTop: '1rem' }}>
        <h2 style={{ fontSize: '1.1rem' }}>Weather (sample)</h2>
        <pre style={{ background: '#f3f4f6', padding: '1rem', borderRadius: '6px' }}>{data ? JSON.stringify(data, null, 2) : 'Loading…'}</pre>
      </div>
    </div>
  )
}

const root = document.getElementById('root')
if (root) {
  createRoot(root).render(<App />)
}
