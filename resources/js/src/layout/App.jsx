
import React from 'react'
import { createRoot } from 'react-dom/client';
import {
    QueryClient,
    QueryClientProvider,
  } from 'react-query'


  const queryClient = new QueryClient()

  export default function App(props) {
    return (
      // Provide the client to your App
      <QueryClientProvider client={queryClient}>
         {props.children}
      </QueryClientProvider>
    )
  }






