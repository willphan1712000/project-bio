import { Theme } from '@radix-ui/themes'
import TemplateContainer from './Template/TemplateContainer'
import "@radix-ui/themes/styles.css";
import Utilities from './Utilities/Utilities';

const App = () => {
  return (
    <Theme accentColor="cyan" radius="full" style={{
        backgroundColor: "transparent",
        minHeight: "auto"
      }}>
      <TemplateContainer />
      <Utilities />
    </Theme>
  )
}

export default App
