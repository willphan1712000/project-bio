import AppLineChart from "./dashboardComponents/AppLineChart"
import StatCards from "./dashboardComponents/StatCards"
import Users from "./dashboardComponents/Users"
import Layout from "./Layout"

const Dashboard = () => {  
  return (
    <Layout heading="Welcome to Link bio Dashboard">
      <StatCards />
      <AppLineChart />
      <Users />
    </Layout>
  )
}

export default Dashboard
