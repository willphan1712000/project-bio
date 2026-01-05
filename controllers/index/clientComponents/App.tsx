import { createAsyncStoragePersister } from "@tanstack/query-async-storage-persister"
import { QueryClient } from "@tanstack/react-query"
import { PersistQueryClientProvider } from "@tanstack/react-query-persist-client"
import Footer from "./Footer/Footer"
import Banner from "./Heading/Banner"
import NavBar from "./NavBar/NavBar"
import AppScrollTrigger from "./ScrollTrigger/AppScrollTrigger"
import Separator from "./Separator"
import Template from "./Template/Template"
import ETemplate from "./eCards/ETemplate"
import * as languages from '../languages'
import { useState } from "react"
import Languages from "../languages/interface"
import { LanguageContext } from "../languages/context"

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      gcTime: 1000 * 60 * 60 * 24, // Cache kept for 24 hours
      staleTime: 1000 * 60 * 5,       // Revalidate every 5 minutes
    },
  },
});

const persister = createAsyncStoragePersister({
  storage: window.localStorage
})

const App = () => {
  const [language, setLanguage] = useState<Languages>(languages.en)

  return (
    <PersistQueryClientProvider client={queryClient} persistOptions={{ persister }}>
      <LanguageContext.Provider value={[language, setLanguage]}>
        <div className="bg-gradient-to-r from-[#C8F8FF] to-[#FFD18C] flex flex-col items-center px-[10px]">
            <NavBar />
            <Banner />
            <Template />
            <Separator />
            <ETemplate />
            <Separator />
            {/* <ECards />
            <Separator /> */}
            <AppScrollTrigger/>
            <Separator />
            {/* <UpSell /> */}
            {/* <Separator /> */}
            <Footer />
        </div>
      </LanguageContext.Provider>
    </PersistQueryClientProvider>
  )
}

export default App
