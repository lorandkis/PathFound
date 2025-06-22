const express = require('express');
const dotenv = require('dotenv');
const cors = require('cors');
const { GoogleGenerativeAI } = require('@google/generative-ai');

dotenv.config();

const app = express();
const port = 4000;

app.use(express.json());
app.use(cors());

app.get('/search', async (req, res) => {
  const { resume, keywords, roles, exclude, locations, job_types } = req.query;

  try {
    const genAI = new GoogleGenerativeAI(process.env.GEMINI_API_KEY);
    const model = genAI.getGenerativeModel({ model: 'gemini-2.5-flash' });

    const prompt = `
    You are a job-matching assistant connected to the web.

    Given the following information:
    - Resume: ${resume}
    - Keywords: ${keywords}
    - Preferred roles: ${roles}
    - Exclude these terms: ${exclude}
    - Locations: ${locations}
    - Job types: ${job_types}

    Requirements:
    1. Only include jobs posted within the last 30 days.
    2. Only include results from **live, verified job postings** — do not fabricate data.
    3. All URLs must be functional and lead to a real job listing.
    4. Return at least 10 valid and relevant job listings.
    5. Each listing must reflect a strong match to the candidate profile.

    Respond only with valid JSON in this format:
    [
      {
        "title": "Frontend Developer – React",
        "company": "TechNova Inc.",
        "location": "Toronto, ON",
        "type": "Remote",
        "url": "https://example.com/job/123",
        "posted": "2025-06-01",
        "description": "Short description of the role.",
        "pct_fit": 91
      }
    ]
    Do not invent or imagine results. Do not include placeholder links.
    `;


    const result = await model.generateContent(prompt);
    const text = result.response.text();
    const match = text.match(/\[\s*{[\s\S]*}\s*\]/);
    const parsed = match ? JSON.parse(match[0]) : [];

    res.json({ results: parsed });
  } catch (error) {
    console.error('AI Error:', error);
    res.status(500).json({ error: 'Failed to generate job matches' });
  }
});

app.listen(port, () => {
  console.log(`🚀 API listening on http://localhost:${port}`);
});
